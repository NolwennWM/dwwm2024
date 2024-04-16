import { Component, Input, OnInit } from '@angular/core';
import { Recette } from '../Recette';
import { RecetteService } from '../recette.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-recette-form',
  templateUrl: './recette-form.component.html',
  styleUrl: './recette-form.component.css'
})
export class RecetteFormComponent implements OnInit{
  @Input() recette?: Recette;

  types: string[] = [];
  ingredientsList: string = "";
  stepsList: string = "";
  isAddForm: boolean = false;

  constructor(private recetteService: RecetteService, private router: Router){}

  ngOnInit(): void 
  {
    this.isAddForm = this.router.url.includes("add");
    // je récupère la liste des types de recette.
    this.types = this.recetteService.getRecetteTypeList();
    if(!this.recette)return;
    // je transforme des tableaux en string.
    this.ingredientsList = this.recette.ingredients.join("\n");
    this.stepsList = this.recette.steps.join("\n");
  }
  hasType(type: string): boolean
  {
    if(!this.recette)return false;
    return this.recette.type.includes(type);
  }
  selectType($event: Event, type: string):void
  {
    if(!this.recette)return;
    const isChecked: boolean = ($event.target as HTMLInputElement).checked;
    this.recette.type = isChecked?type:"";
  }
  onSubmit(): void
  {
    if(this.recette)
    {
      // Je transforme mes strings en tableau :
      this.recette.ingredients = this.ingredientsList.split("\n");
      this.recette.steps = this.stepsList.split("\n");

      if(this.isAddForm)
      {
        this.recetteService.addRecette(this.recette).subscribe(
          (recette)=>this.router.navigate(["/recettes", recette.id])
        );
      }
      else
      {
        this.recetteService.updateRecette(this.recette).subscribe(
          ()=>this.router.navigate(["/recettes", this.recette?.id])
        );
      }
    }
    // this.router.navigate(["/recettes", this.recette?.id]);
  }
}
