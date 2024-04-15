import { Directive, ElementRef, HostListener, Input } from '@angular/core';
type shadow = [number, number, number, number];

@Directive({
  selector: '[appBorderCard]'
})
export class BorderCardDirective {
  defaultColor = "black";
  defaultBorder = 2;
  defaultShadow: shadow = [5, 5, 10, 2];
  changedShadow: shadow = [5, 5, 20, 2];
  // Par défaut, la propriété doit s'appeler comme le selecteur:
  @Input() appBorderCard: string|undefined;
  // Si on souhaite changer le nom de la propriété :
  @Input("appBorderCard") borderColor: string|undefined;
  
  constructor(private el: ElementRef) 
  { 
    this.setShadow(...this.defaultShadow, this.defaultColor);
    this.setBorder(this.defaultBorder, this.defaultColor);
  }

  private setShadow(x: number, y: number, blur: number, radius: number, color: string)
  {
    this.el.nativeElement.style.boxShadow = `${x}px ${y}px ${blur}px ${radius}px ${color}`;
  }
  private setBorder(size: number, color: string)
  {
    this.el.nativeElement.style.border = `${size}px solid ${color}`;
  }
  @HostListener("mouseenter") onMouseEnter()
  {
    this.setBorder(this.defaultBorder, this.borderColor||"green");
    this.setShadow(...this.changedShadow, this.borderColor||"green");
  }
  @HostListener("mouseleave") onMouseLeave()
  {
    // Même valeur que dans le constructor :
    this.setShadow(...this.defaultShadow, this.defaultColor);
    this.setBorder(this.defaultBorder, this.defaultColor);
  }
}
