import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { MainLayoutComponent } from './layouts/main-layout/main-layout.component';
import { DoctorLoginComponent } from './pages/doctor/doctor-login/doctor-login.component';
import { DoctorSignUpComponent } from './pages/doctor/doctor-sign-up/doctor-sign-up.component';
import { PatientLoginComponent } from './pages/patient/patient-login/patient-login.component';
import { UserSignUpComponent } from './pages/patient/user-sign-up/user-sign-up.component';
import { ForgotPasswordComponent } from './pages/shared/forgot-password/forgot-password.component';
import { StaffLoginComponent } from './pages/staff/staff-login/staff-login.component';

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  {
    path: 'doctor-login',
    component: DoctorLoginComponent,
  },
  {
    path: 'staff-login',
    component: StaffLoginComponent,
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
    path: 'forgot-password',
    component: ForgotPasswordComponent,
  },
  {
    path: '',
    component: MainLayoutComponent,
    children: [
      {
        path: '',
        loadChildren: () =>
          import('./layouts/main-layout/main-layout.module').then(
            (m) => m.MainLayoutModule
          ),
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
