import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';

import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { ClientsComponent } from './components/clients/clients.component';
import { CworkerComponent } from './components/cworker/cworker.component';
import { ComponentsComponent } from './components/components.component';

import { HomeComponent } from './components/home/home.component';
import { ProfileComponent } from './components/profile/profile.component';
import { WorkerRegComponent } from './components/worker-reg/worker-reg.component';


const routes: Routes = [
	{path: 'home', component: HomeComponent},
	{path: '', redirectTo: '/home', pathMatch: 'full'},
	{path: 'try', component: ComponentsComponent},
	{path: 'login', component: LoginComponent},
	{path: 'register', component: RegisterComponent},
	{path: 'client', component: ClientsComponent},
	{path: 'worker', component: CworkerComponent},
	{path: 'profile', component: ProfileComponent},
	{path: 'worker-reg', component: WorkerRegComponent}
];

@NgModule({
  imports: [CommonModule, RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
