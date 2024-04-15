import { Routes } from "@angular/router";
import { ListeRecetteComponent } from "./liste-recette/liste-recette.component";
import { DetailRecetteComponent } from "./detail-recette/detail-recette.component";


export const recetteRoutes : Routes = [
    {path: "", component: ListeRecetteComponent},
    {path: ":id", component: DetailRecetteComponent}
];