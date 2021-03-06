import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})


export class RESTService {
  
  constructor(private http: HttpClient) {}
  REST_SERVER = 'http://localhost/isearch/isearch/api/worker/ReadWorkers.php'
  workerData()
  {
    return this.http.get<any>(this.REST_SERVER);
  }

}