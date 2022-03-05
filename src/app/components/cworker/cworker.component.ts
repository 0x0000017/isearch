import { Component, OnInit } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from '@angular/common';
import { RESTService } from 'src/app/rest.service';
import { Users } from 'src/app/Users';



@Component({
  selector: 'app-cworker',
  templateUrl: './cworker.component.html',
  styleUrls: ['./cworker.component.css']

})
export class CworkerComponent implements OnInit {

  constructor(private rs: RESTService) {}
  columns = ["Worker Name", "Worker Description", "Worker Category"];
  index = ["worker_name", "worker_desc", "worker_category"];
  users: Users[] = [];


  ngOnInit(): void {
    this.rs.getUsers().subscribe
    (
      (response) =>
      {
        this.users = response;
      },
      (error) => console.log(error)
      )
  } 
}