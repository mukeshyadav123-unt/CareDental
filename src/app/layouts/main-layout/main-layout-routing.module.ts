import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DoctorVisitsComponent } from 'src/app/pages/doctor/doctor-visits/doctor-visits.component';
import { HomeComponent } from 'src/app/pages/doctor/home/home.component';
import { ProfileComponent } from 'src/app/pages/shared/profile/profile.component';
import { WorkTimesComponent } from 'src/app/pages/doctor/work-times/work-times.component';
import { AuthGuard } from 'src/app/_guard';
import { ReservationsComponent } from 'src/app/pages/patient/reservations/reservations.component';
import { DoctorPageComponent } from 'src/app/pages/doctor/doctor-page/doctor-page.component';
import { VisitsComponent } from 'src/app/pages/patient/visits/visits.component';
import { EmailVerificationComponent } from 'src/app/pages/shared/email-verification/email-verification.component';
import { ChatComponent } from 'src/app/pages/shared/chat/chat.component';

const routes: Routes = [
  {
    path: 'home',
    component: HomeComponent,
  },
  {
    path: 'profile',
    component: ProfileComponent,
    canActivate: [AuthGuard],
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
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MainLayoutRoutingModule {}
