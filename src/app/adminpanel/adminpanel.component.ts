import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { RESTService } from 'src/app/rest.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-adminpanel',
  templateUrl: './adminpanel.component.html',
  styleUrls: ['./adminpanel.component.css']
})
export class AdminpanelComponent implements OnInit {

  worker: any = [];
  status;
  postData = {};
  fileName = '';
  convertedImg
  postId;
  picNum = 100;
  url = 'http://localhost/isearch/isearch/api/worker/UpdateWorker.php';
  delUrl = 'http://localhost/isearch/isearch/api/worker/DeleteWorker.php'

  onFileSelected(event) {
    const file = event.target.files[0]
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      this.convertedImg = reader.result
      return this.convertedImg
    }
  }

  constructor(private http: HttpClient, private restService: RESTService,private modalService: NgbModal) {
    let headers = new HttpHeaders()
    headers=headers.append('content-type','application/json')
    headers=headers.append('Access-Control-Allow-Origin', '*')
    headers=headers.append('content-type','application/x-www-form-urlencoded')
    headers=headers.append('Access-Control-Allow-Headers', '*')
  }

  getWorker() {
    
    this.restService.workerData().subscribe((data: any[])=>{
      console.log(data);
      this.worker = data; })

  }

  deleteWorker() {
    let w_id = (<HTMLInputElement>document.getElementById("worker_id")).value

    this.postData = {
      worker_id: w_id
    }
      this.http.post<any>(this.delUrl,this.postData).subscribe(data => {console.log(data)})

  }

  updateWorkers(){
    let w_name = (<HTMLInputElement>document.getElementById("fullName")).value,
    w_email = (<HTMLInputElement>document.getElementById("email")).value,
    w_phone = (<HTMLInputElement>document.getElementById("pnumber")).value,
    w_cat = (<HTMLInputElement>document.getElementById("worker_category")).value,
    w_addr = (<HTMLInputElement>document.getElementById("worker_address")).value,
    w_pic = (<HTMLInputElement>document.getElementById("worker_pic")).value,
    w_desc = (<HTMLInputElement>document.getElementById("worker_description")).value,
    w_id = (<HTMLInputElement>document.getElementById("worker_id")).value

    this.postData = {
      worker_name : w_name,
      worker_email : w_email,
      worker_phone: w_phone,
      worker_pic: w_pic,
      worker_category : w_cat,
      worker_address : w_addr,
      worker_desc: w_desc,
      worker_id: w_id 
    };

    const headers = {'content-type' :'application/json', 'Access-Control-Allow-Methods': '*'}
      this.http.put<any>(this.url,this.postData, {headers}).subscribe(data => {console.log(data)})

    this.getWorker()
  }

  open(content) {
    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'})
  }
  
  delDialog(content2) {
    this.modalService.open(content2, {ariaLabelledBy: 'modal-2'})
  }

  ngOnInit(): void {
    this.getWorker()
    
  }

}
