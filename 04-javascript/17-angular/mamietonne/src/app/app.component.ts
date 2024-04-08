import { Component, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { RECETTES } from './RecetteList';
import { Recette } from './Recette';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, CommonModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent implements OnInit{
  title = 'Super mamietonne ';
  recetteList: Recette[] = RECETTES;
  recetteSelected: Recette|undefined;

  ngOnInit(): void
  {
    console.table(this.recetteList);    
    // this.selectRecette(this.recetteList[0]);
  }
  selectRecette(recetteId: string): void
  {
    const index: number = parseInt(recetteId);
    const recette: Recette|undefined = this.recetteList.find(rec=>rec.id === index);
    if(recette)
    {
      console.log(`Vous avez sélectionné ${recette.name}`);   
    }
    else
    {
      console.log("Aucune recette correspondante");
    }
    this.recetteSelected = recette;
  }
}
