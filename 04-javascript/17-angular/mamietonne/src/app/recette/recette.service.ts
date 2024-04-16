import { Injectable } from '@angular/core';
import { Recette, Types } from './Recette';
import { RECETTES } from './RecetteList';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, catchError, of, tap } from 'rxjs';

@Injectable()
export class RecetteService {

  constructor(private http: HttpClient) { }
  getRecetteList(): Observable<Recette[]>
  {
    return this.http.get<Recette[]>("api/recettes").pipe(
      tap(this.log),
      catchError(err=>this.handleError(err, []))
    );
  }
  getRecetteById(recetteId: number): Observable<Recette|undefined>
  {
    return this.http.get<Recette>(`api/recettes/${recetteId}`).pipe(
      tap(this.log),
      catchError(err=>this.handleError(err, undefined))
    );
  }
  getRecetteTypeList():string[]
  {
    return Object.values(Types);
  }
  private log(response: any)
  {
    console.table(response);
  }
  private handleError(error: Error, response: any)
  {
    console.error(error);
    return of(response);
  }
  updateRecette(recette:Recette): Observable<null>
  {
    const options = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
    return this.http.put<null>("api/recettes", recette, options).pipe(
      tap(this.log),
      catchError(err=>this.handleError(err, undefined))
    );
  }
  deleteRecetteById(recetteId: number): Observable<null>
  {
    return this.http.delete(`api/recettes/${recetteId}`).pipe(
      tap(this.log),
      catchError(err=>this.handleError(err, undefined))
    );
  }
  addRecette(recette:Recette): Observable<Recette>
  {
    const options = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
    return this.http.post<Recette>("api/recettes", recette, options).pipe(
      tap(this.log),
      catchError(err=>this.handleError(err, undefined))
    );
  }
}
