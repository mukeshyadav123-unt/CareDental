import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DoctorVisitsComponent } from 'src/app/pages/doctor/doctor-visits/doctor-visits.component';
import { HomeComponent } from 'src/app/pages/doctor/home/home.component';
import { ProfileComponent } from 'src/app/pages/patient/profile/profile.component';
import { WorkTimesComponent } from 'src/app/pages/doctor/work-times/work-times.component';
import { AuthGuard } from 'src/app/_guard';
import { ReservationsComponent } from 'src/app/pages/patient/reservations/reservations.component';
import { DoctorPageComponent } from 'src/app/pages/doctor/doctor-page/doctor-page.component';
import { VisitsComponent } from 'src/app/pages/patient/visits/visits.component';
import { EmailVerificationComponent } from 'src/app/pages/shared/email-verification/email-verification.component';
import { ChatComponent } from 'src/app/pages/shared/chat/chat.component';
import { DoctorProfileComponent } from 'src/app/pages/doctor/doctor-profile/doctor-profile.component';
import { ContactUsComponent } from 'src/app/pages/shared/contact-us/contact-us.component';
import { AllVisitsComponent } from 'src/app/pages/staff/all-visits/all-visits.component';
import { AllDoctorsComponent } from 'src/app/pages/staff/all-doctors/all-doctors.component';
import { AllReportsComponent } from 'src/app/pages/staff/all-reports/all-reports.component';
import { AllPatientsComponent } from 'src/app/pages/staff/all-patients/all-patients.component';

const routes: Routes = [
  {
    path: 'home',
    component: HomeComponent,
  },
  {
    path: 'contact-us',
    component: ContactUsComponent,
  },
  {
    path: 'user-profile',
    component: ProfileComponent,
    canActivate: [AuthGuard],
    data: { roles: ['user'] },
  },
  {
    path: 'doctor-profile',
    component: DoctorProfileComponent,
    canActivate: [AuthGuard],
    data: { roles: ['doctor'] },
  },
  {
    path: 'times',
    component: WorkTimesComponent,
    canActivate: [AuthGuard],
    data: { roles: ['doctor'] },
  },
  {
    path: 'visits',
    component: DoctorVisitsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['doctor'] },
  },
  {
    path: 'reservations',
    component: ReservationsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['user'] },
  },
  {
    path: 'doctor/:id',
    component: DoctorPageComponent,
    canActivate: [AuthGuard],
  },
  {
    path: 'user-visits',
    component: VisitsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['user'] },
  },
  {
    path: 'verify-email',
    component: EmailVerificationComponent,
    canActivate: [AuthGuard],
  },
  {
    path: 'chat',
    component: ChatComponent,
    canActivate: [AuthGuard],
  },
  {
    path: 'admin/visits',
    component: AllVisitsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['staff'] },
  },
  {
    path: 'admin/doctors',
    component: AllDoctorsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['staff'] },
  },
  {
    path: 'admin/reports',
    component: AllReportsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['staff'] },
  },
  {
    path: 'admin/patients',
    component: AllPatientsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['staff'] },
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MainLayoutRoutingModule {}
