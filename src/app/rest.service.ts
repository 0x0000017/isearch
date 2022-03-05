import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Users } from './Users';


@Injectable({
  providedIn: 'root'
})


export class RESTService {
  
  constructor(private http: HttpClient) {}
  url = 'http://localhost:3000/users'
  getUsers()
  {
    return this.http.get<Users[]>(this.url);
  }

}