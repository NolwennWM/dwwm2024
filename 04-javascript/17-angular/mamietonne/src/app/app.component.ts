import { Component, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent implements OnInit{
  title = 'Super mamietonne ';
  recetteList = ["Carbonade", "Okonomiyaki", "Cannelé"];

  ngOnInit(): void
  {
    console.table(this.recetteList);    
    this.selectRecette(this.recetteList[0]);
  }
  selectRecette(nom:string): void
  {
    console.log(`Vous avez sélectionné ${nom}`);    
  }
}
