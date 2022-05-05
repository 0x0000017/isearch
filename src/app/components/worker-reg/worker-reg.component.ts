import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-worker-reg',
  templateUrl: './worker-reg.component.html',
  styleUrls: ['./worker-reg.component.css']
})
export class WorkerRegComponent implements OnInit {

  postData = {};
  url = 'http://localhost/isearch/isearch/api/worker/CreateWorker.php';
  
  submitInfo() {
    let ready = 1;

    let w_name = (<HTMLInputElement>document.getElementById("fullName")).value,
    w_email = (<HTMLInputElement>document.getElementById("email")).value,
    w_phone = (<HTMLInputElement>document.getElementById("pnumber")).value,
    w_cat = (<HTMLInputElement>document.getElementById("worker_category")).value,
    w_addr = (<HTMLInputElement>document.getElementById("worker_address")).value

    
    this.postData = {
      worker_name : w_name,
      worker_email : w_email,
      worker_phone: w_phone,
      worker_category : w_cat,
      worker_address : w_addr
    };

    console.log(w_name, w_email, w_phone, ready);
    if (ready == 1 && w_phone && w_cat && w_addr && w_email && w_name) {
      this.http.post(this.url, this.postData).toPromise()
      if (window.confirm('Success. Click OK to go back to home '))
      {
        window.location.href='/home';
      };
      
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
