import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  redirectUrl = '/';
  userSubject: BehaviorSubject<any> = new BehaviorSubject(null);

  constructor(
    private _HttpClient: HttpClient,
    private _CookieService: CookieService,
    private router: Router
  ) {
    this.userSubject = new BehaviorSubject<any>(
      JSON.parse(localStorage.getItem('currentUser-hospital') || '{}')
    );
  }

  public userLogin(user: any): Observable<any> {
    return this._HttpClient
      .post(`${environment.api}/api/patient/login`, user, {
        responseType: 'json',
      })
      .pipe(
        map((response: any) => {
          if (response) {
            this._CookieService.set('Token', response['token']);
            const body = { role: 'user' };
            this.userSubject.next(body);
            localStorage.setItem('currentUser-hospital', JSON.stringify(body));
            this.router.navigate([this.redirectUrl]);
          }
        })
      );
  }

  public forgotPassword(email: string): Observable<any> {
    return this._HttpClient.post(
      `${environment.api}/api/forgot-password`,
      { email },
      {
        responseType: 'json',
      }
    );
  }

  public resetPassword(newPassword: any): Observable<any> {
    return this._HttpClient.post(
      `${environment.api}/api/reset-password`,
      newPassword,
      {
        responseType: 'json',
      }
    );
  }

  public userRegister(user: any): Observable<any> {
    return this._HttpClient
      .post(`${environment.api}/api/patient/signup`, user)
      .pipe(
        map((response) => {
          if (response) {
            this.router.navigate(['/user-login']);
          }
        })
      );
  }
  public doctorLogin(doctor: any): Observable<any> {
    return this._HttpClient
      .post(`${environment.api}/api/doctor/login`, doctor, {
        responseType: 'json',
      })
      .pipe(
        map((response: any) => {
          if (response) {
            this._CookieService.set('Token', response['token']);
            const body = { role: 'doctor' };
            this.userSubject.next(body);
            localStorage.setItem('currentUser-hospital', JSON.stringify(body));
            this.router.navigate([this.redirectUrl]);
          }
        })
      );
  }
  public staffLogin(staff: any): Observable<any> {
    return this._HttpClient
      .post(`${environment.api}/api/staff/login`, staff, {
        responseType: 'json',
      })
      .pipe(
        map((response: any) => {
          if (response) {
            this._CookieService.set('Token', response['token']);
            const body = { role: 'staff' };
            this.userSubject.next(body);
            localStorage.setItem('currentUser-hospital', JSON.stringify(body));
            this.router.navigate([this.redirectUrl]);
          }
        })
      );
  }
  public doctorRegister(user: any): Observable<any> {
    return this._HttpClient
      .post(`${environment.api}/api/doctor/signup`, user)
      .pipe(
        map((response) => {
          if (response) {
            this.router.navigate(['/doctor-login']);
          }
        })
      );
  }

  public verifyEmail(code: any): Observable<any> {
    return this._HttpClient.post(`${environment.api}/api/verify-email`, {
      code,
    });
  }

  public resendCode(): Observable<any> {
    return this._HttpClient.get(`${environment.api}/api/verify-email/resend`);
  }

  public logout() {
    this._CookieService.deleteAll();
    this.router.navigate(['/doctor-login']);
    this.userSubject.next({});
    localStorage.clear();
  }

  getMe() {
    return this._HttpClient.get(`${environment.api}/api/me`);
  }

  updatePatientProfile(profile: any) {
    return this._HttpClient.post(
      `${environment.api}/api/patient/profile`,
      profile
    );
  }

  getPatientProfile() {
    return this._HttpClient.get(`${environment.api}/api/patient/profile`);
  }

  updateDoctorProfile(profile: any) {
    return this._HttpClient.post(
      `${environment.api}/api/doctor-routes/profile`,
      profile
    );
  }

  getDoctorProfile() {
    return this._HttpClient.get(`${environment.api}/api/doctor-routes/profile`);
  }
}
