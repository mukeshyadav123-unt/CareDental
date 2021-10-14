import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DoctorVisitsComponent } from 'src/app/pages/doctor-visits/doctor-visits.component';
import { HomeComponent } from 'src/app/pages/home/home.component';
import { ProfileComponent } from 'src/app/pages/profile/profile.component';
import { WorkTimesComponent } from 'src/app/pages/work-times/work-times.component';
import { AuthGuard } from 'src/app/_guard';

const routes: Routes = [
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
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MainLayoutRoutingModule {}
