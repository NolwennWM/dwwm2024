import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListeRecetteComponent } from './liste-recette/liste-recette.component';
import { DetailRecetteComponent } from './detail-recette/detail-recette.component';
import { BorderCardDirective } from './border-card.directive';
import { TypeColorPipe } from './type-color.pipe';
import { RouterModule } from '@angular/router';
import { recetteRoutes } from './recette.routes';
import { RecetteService } from './recette.service';
import { FormsModule } from '@angular/forms';
import { EditRecetteComponent } from './edit-recette/edit-recette.component';
import { RecetteFormComponent } from './recette-form/recette-form.component';

@NgModule({
  declarations: [
    ListeRecetteComponent,
    DetailRecetteComponent,
    BorderCardDirective,
    TypeColorPipe,
    EditRecetteComponent,
    RecetteFormComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(recetteRoutes),
    FormsModule
  ],
  providers: [RecetteService]
})
export class RecetteModule { }
