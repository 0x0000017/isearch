import { Component, Input, NgModule, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { DomSanitizer } from '@angular/platform-browser';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { HttpHeaders } from '@angular/common/http';
import { RESTService } from 'src/app/rest.service';

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
const headers= new HttpHeaders()
  .set('content-type', 'application/json')
  .set('Access-Control-Allow-Origin', '*');


@Component({
  selector: 'app-cworker',
  templateUrl: './cworker.component.html',
  styleUrls: ['./cworker.component.css']

})

export class CworkerComponent implements OnInit {
 
  public searchFilter: any ='';
  query: any = [];
  worker: any = [];
  convImg;


  constructor(private httpClient: HttpClient, private _sanitizer: DomSanitizer, private modalService: NgbModal, private restService: RESTService) {}

  open(content) {
    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'})
  }



  getWorker() {
    
    // this.httpClient.get<any>('http://localhost:3000/Users').subscribe(response => this.worker = response);
    this.restService.workerData().subscribe((data: any[])=>{
      console.log(data);
      this.worker = data; })

  }

  ngOnInit(): void {
    this.getWorker();

  } 

}