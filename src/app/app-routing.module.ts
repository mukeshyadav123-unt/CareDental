import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { MainLayoutComponent } from './layouts/main-layout/main-layout.component';
import { DoctorLoginComponent } from './pages/doctor-login/doctor-login.component';
import { DoctorSignUpComponent } from './pages/doctor-sign-up/doctor-sign-up.component';
import { PatientLoginComponent } from './pages/patient-login/patient-login.component';
import { UserSignUpComponent } from './pages/user-sign-up/user-sign-up.component';

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
