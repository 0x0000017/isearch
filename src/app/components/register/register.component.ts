import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';


@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})

export class RegisterComponent implements OnInit {

  postData = {};
  url = 'http://localhost/isearch/isearch/api/customer/CreateCustomer.php';
  
  submitInfo() {
    let ready = 1;
    let cus_name = (<HTMLInputElement>document.getElementById("fullName")).value,
    cus_email = (<HTMLInputElement>document.getElementById("email")).value,
    cus_pw = (<HTMLInputElement>document.getElementById("password")).value,
    pwconfirm = (<HTMLInputElement>document.getElementById("confirmPassword")).value
    
    this.postData = {
      customer_name : cus_name,
      customer_email : cus_email,
      customer_password: cus_pw,
      customer_pic : 'wala eh'
    };

    console.log(cus_name, cus_email, cus_pw, pwconfirm, ready);
    if (ready == 1 && cus_pw == pwconfirm && cus_email && cus_name) {
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
