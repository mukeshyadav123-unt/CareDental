import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DoctorLoginComponent } from './pages/doctor-login/doctor-login.component';
import { DoctorSignUpComponent } from './pages/doctor-sign-up/doctor-sign-up.component';
import { HomeComponent } from './pages/home/home.component';
import { PatientLoginComponent } from './pages/patient-login/patient-login.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { UserSignUpComponent } from './pages/user-sign-up/user-sign-up.component';
import { AuthGuard } from './_guard';

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  {
    path: 'doctor-login',
    component: DoctorLoginComponent,
  },
  {
    path: 'user-login',
    component: PatientLoginComponent,
  },
  {
    path: 'doctor-signup',
    component: DoctorSignUpComponent,
  },
  {
    path: 'user-signup',
    component: UserSignUpComponent,
  },
  {
    path: 'home',
    component: HomeComponent,
    canActivate: [AuthGuard],
  },
  {
    path: 'profile',
    component: ProfileComponent,
    canActivate: [AuthGuard],
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
