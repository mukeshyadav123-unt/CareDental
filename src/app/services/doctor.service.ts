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
export class DoctorService {
  redirectUrl = '/';

  constructor(
    private _HttpClient: HttpClient,
    private _CookieService: CookieService,
    private router: Router
  ) {}
  public login(doctor: any): Observable<any> {
    return this._HttpClient
      .post(`${environment.api}/api/doctor/login`, doctor, {
        responseType: 'json',
      })
      .pipe(
        map((response: any) => {
          if (response) {
            this._CookieService.set('Token', response['token']);

            this.router.navigate([this.redirectUrl]);
          }
        })
      );
  }
  public register(user: any): Observable<any> {
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

  public logout() {
    this._CookieService.delete('Token');
    this.router.navigate(['/register']);
  }
}
