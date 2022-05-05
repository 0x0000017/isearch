import { Component, NgModule, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { RouterModule } from '@angular/router';

import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from '@angular/common';
import { Observable } from 'rxjs';


export class Worker {
  constructor(
    public worker_id: number,
    public worker_name: string,
    public worker_email: string,
    public worker_phone: string,
    public worker_pic: string,
    public worker_desc: string,
    public worker_category: string,
    public worker_address: string,)
  {
    
  }
}


@Component({
  selector: 'app-cworker',
  templateUrl: './cworker.component.html',
  styleUrls: ['./cworker.component.css']

})


export class CworkerComponent implements OnInit {

  worker: any[];
  constructor(private httpClient: HttpClient) {}

  getWorker() {
    
    this.httpClient.get<any>('http://localhost:3000/Users').subscribe(response => this.worker = response);

  }


  ngOnInit(): void {
    this.getWorker()
  } 
}