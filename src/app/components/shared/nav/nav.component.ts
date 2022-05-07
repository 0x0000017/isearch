import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css']
})
export class NavComponent implements OnInit {
  public searchFilter: any ='';
  query: any[];

  constructor() { }

  ngOnInit(): void {
  }

}
