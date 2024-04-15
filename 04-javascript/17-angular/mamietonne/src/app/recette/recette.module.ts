import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListeRecetteComponent } from './liste-recette/liste-recette.component';
import { DetailRecetteComponent } from './detail-recette/detail-recette.component';
import { BorderCardDirective } from './border-card.directive';
import { TypeColorPipe } from './type-color.pipe';
import { RouterModule } from '@angular/router';
import { recetteRoutes } from './recette.routes';

@NgModule({
  declarations: [
    ListeRecetteComponent,
    DetailRecetteComponent,
    BorderCardDirective,
    TypeColorPipe
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(recetteRoutes)
  ]
})
export class RecetteModule { }
