import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { BorderCardDirective } from '../border-card.directive';
import { TypeColorPipe } from '../type-color.pipe';
import { Recette } from '../Recette';
import { RECETTES } from '../RecetteList';

@Component({
  selector: 'app-liste-recette',
  standalone: true,
  imports: [ CommonModule, BorderCardDirective, TypeColorPipe],
  templateUrl: './liste-recette.component.html',
  styleUrl: './liste-recette.component.css'
})
export class ListeRecetteComponent implements OnInit{
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
