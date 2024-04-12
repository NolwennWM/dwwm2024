import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'typeColor',
  standalone: true
})
export class TypeColorPipe implements PipeTransform {

  transform(value: string): string 
  {
    let color: string = "";
    switch(value)
    {
      case "entrée":
        color = "green";
        break;
      case "plat":
        color = "brown";
        break;
      case "dessert":
        color = "pink";
        break;
    }
    return color;
  }

}
