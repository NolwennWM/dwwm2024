import { Injectable } from '@angular/core';
import { Recette, Types } from './Recette';
import { RECETTES } from './RecetteList';

@Injectable()
export class RecetteService {

  constructor() { }
  getRecetteList(): Recette[]
  {
    return RECETTES;
  }
  getRecetteById(recetteId: number): Recette|undefined
  {
    return RECETTES.find(rec=>rec.id===recetteId);
  }
  getRecetteTypeList():string[]
  {
    return Object.values(Types);
  }
}
