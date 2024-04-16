import { Routes } from "@angular/router";
import { ListeRecetteComponent } from "./liste-recette/liste-recette.component";
import { DetailRecetteComponent } from "./detail-recette/detail-recette.component";
import { EditRecetteComponent } from "./edit-recette/edit-recette.component";
import { AddRecetteComponent } from "./add-recette/add-recette.component";


export const recetteRoutes : Routes = [
    {path: "", component: ListeRecetteComponent},
    {path: "add", component: AddRecetteComponent},
    {path: "edit/:id", component: EditRecetteComponent},
    {path: ":id", component: DetailRecetteComponent}
];