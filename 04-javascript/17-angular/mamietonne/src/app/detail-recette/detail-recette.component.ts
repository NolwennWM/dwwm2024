import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Recette } from '../Recette';
import { RECETTES } from '../RecetteList';
import { CommonModule } from '@angular/common';
import { TypeColorPipe } from '../type-color.pipe';

@Component({
  selector: 'app-detail-recette',
  standalone: true,
  imports: [CommonModule, TypeColorPipe],
  templateUrl: './detail-recette.component.html',
  styleUrl: './detail-recette.component.css'
})
export class DetailRecetteComponent implements OnInit
{
  recetteList: Recette[] = RECETTES;
  recette: Recette|undefined;
  constructor(private route: ActivatedRoute){}
  ngOnInit(): void 
  {
    const recetteId: number = parseInt(this.route.snapshot.paramMap.get("id")??"");
    console.log(recetteId);
    this.recette = this.recetteList.find(rec=>rec.id===recetteId);
    console.log(this.recette);
    
  }
}
