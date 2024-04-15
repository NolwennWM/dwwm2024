export enum Types{starter="entrée", dish="plat", dessert="dessert"}
export interface Recette{
    id?: number;
    name: string;
    type: Types|string;
    duration: number;
    description: string;
    ingredients: string[];
    steps: string[];
    image: string;
    createdAt: Date;
}