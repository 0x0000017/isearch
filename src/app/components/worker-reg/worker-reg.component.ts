import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-worker-reg',
  templateUrl: './worker-reg.component.html',
  styleUrls: ['./worker-reg.component.css']
})
export class WorkerRegComponent implements OnInit {

  postData = {};
  fileName = '';
  convertedImg
  postId;
  picNum = 100;
  url = 'http://localhost/isearch/isearch/api/worker/CreateWorker.php';

  onFileSelected(event) {
    const file = event.target.files[0]
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      this.convertedImg = reader.result
      return this.convertedImg
    }
  }


  addWorkers(){
    let w_name = (<HTMLInputElement>document.getElementById("fullName")).value,
    w_email = (<HTMLInputElement>document.getElementById("email")).value,
    w_phone = (<HTMLInputElement>document.getElementById("pnumber")).value,
    w_cat = (<HTMLInputElement>document.getElementById("worker_category")).value,
    w_addr = (<HTMLInputElement>document.getElementById("worker_address")).value,
    w_pic = (<HTMLInputElement>document.getElementById("worker_pic")).value,
    w_desc = (<HTMLInputElement>document.getElementById("worker_description")).value

    this.postData = {
      worker_name : w_name,
      worker_email : w_email,
      worker_phone: w_phone,
      worker_pic: this.convertedImg,
      worker_category : w_cat,
      worker_address : w_addr,
      worker_desc: w_desc
    };

    const headers = {'content-type' :'application/json'}
    if (w_name && w_email && w_phone && w_pic && w_addr && w_cat && w_desc) {
      this.http.post<any>(this.url,this.postData, {headers}).subscribe(data => {console.log(data)})
      window.location.href='/worker';
    } else {
          alert("Invalid details ! Please check again !");
      }
  }

  constructor(private http: HttpClient) { 
    let headers = new HttpHeaders()
    headers=headers.append('content-type','application/json')
    headers=headers.append('Access-Control-Allow-Origin', '*')
    headers=headers.append('content-type','application/x-www-form-urlencoded')
    headers=headers.append('Access-Control-Allow-Headers', '*')
  }

  ngOnInit(): void {
    
  }

}
