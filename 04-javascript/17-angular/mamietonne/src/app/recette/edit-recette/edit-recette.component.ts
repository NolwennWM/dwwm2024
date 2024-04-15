import { Component, OnInit } from '@angular/core';
import { Recette } from '../Recette';
import { ActivatedRoute } from '@angular/router';
import { RecetteService } from '../recette.service';

@Component({
  selector: 'app-edit-recette',
  templateUrl: './edit-recette.component.html',
  styleUrl: './edit-recette.component.css'
})
export class EditRecetteComponent implements OnInit{
  recette?: Recette;

  constructor(private route: ActivatedRoute, private recetteService: RecetteService){}

  ngOnInit(): void 
  {
    const recetteId: number = parseInt(this.route.snapshot.paramMap.get("id")??"");
    this.recette = this.recetteService.getRecetteById(recetteId);
  }
}
