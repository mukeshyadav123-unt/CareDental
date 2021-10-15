import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DoctorLoginComponent } from './pages/doctor/doctor-login/doctor-login.component';
import { PatientLoginComponent } from './pages/patient/patient-login/patient-login.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { CookieService } from 'ngx-cookie-service';
import { HomeComponent } from './pages/doctor/home/home.component';
import { AuthGuard } from './_guard';
import { ErrorInterceptor } from './_helpers/error.interceptor';
import { JwtInterceptor } from './_helpers/jwt.interceptor';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FormsModule } from '@angular/forms';
import { DoctorSignUpComponent } from './pages/doctor/doctor-sign-up/doctor-sign-up.component';
import { UserSignUpComponent } from './pages/patient/user-sign-up/user-sign-up.component';
import { ProfileComponent } from './pages/shared/profile/profile.component';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { NavbarComponent } from './shared/navbar/navbar.component';
import { MainLayoutModule } from './layouts/main-layout/main-layout.module';
import { WorkTimesComponent } from './pages/doctor/work-times/work-times.component';
import { DoctorVisitsComponent } from './pages/doctor/doctor-visits/doctor-visits.component';

@NgModule({
  declarations: [
    AppComponent,
    DoctorLoginComponent,
    PatientLoginComponent,
    HomeComponent,
    DoctorSignUpComponent,
    UserSignUpComponent,
    ProfileComponent,
    NavbarComponent,
    WorkTimesComponent,
    DoctorVisitsComponent,
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ToastrModule.forRoot(),
    CarouselModule,
    MainLayoutModule,
  ],
  providers: [
    CookieService,
    AuthGuard,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: JwtInterceptor,
      multi: true,
    },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
