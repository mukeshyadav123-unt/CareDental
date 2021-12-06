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
import { DoctorProfileComponent } from 'src/app/pages/doctor/doctor-profile/doctor-profile.component';
import { ContactUsComponent } from 'src/app/pages/shared/contact-us/contact-us.component';
import { AllVisitsComponent } from 'src/app/pages/staff/all-visits/all-visits.component';
import { AllDoctorsComponent } from 'src/app/pages/staff/all-doctors/all-doctors.component';
import { AllReportsComponent } from 'src/app/pages/staff/all-reports/all-reports.component';
import { AllPatientsComponent } from 'src/app/pages/staff/all-patients/all-patients.component';
import { MyReportsComponent } from 'src/app/pages/patient/my-reports/my-reports.component';
import { FacilitiesComponent } from 'src/app/pages/facilities/facilities.component';
import { AboutUsComponent } from 'src/app/pages/about-us/about-us.component';
import { OurStaffComponent } from 'src/app/pages/our-staff/our-staff.component';

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
    path: 'facilities',
    component: FacilitiesComponent,
  },
  {
    path: 'about-us',
    component: AboutUsComponent,
  },
  {
    path: 'our-staff',
    component: OurStaffComponent,
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
    path: 'user-reports',
    component: MyReportsComponent,
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
    path: 'admin/visits',
    component: AllVisitsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['admin'] },
  },
  {
    path: 'admin/doctors',
    component: AllDoctorsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['admin'] },
  },
  {
    path: 'admin/reports',
    component: AllReportsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['admin'] },
  },
  {
    path: 'admin/patients',
    component: AllPatientsComponent,
    canActivate: [AuthGuard],
    data: { roles: ['admin'] },
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MainLayoutRoutingModule {}
