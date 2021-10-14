import { Injectable } from '@angular/core';
import {
  CanActivate,
  ActivatedRouteSnapshot,
  RouterStateSnapshot,
  Router,
} from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';
import { CookieService } from 'ngx-cookie-service';

@Injectable()
export class AuthGuard implements CanActivate {
  constructor(
    protected router: Router,
    protected authService: AuthService,
    private _CookieService: CookieService
  ) {}

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean> | boolean {
    let url: string = state.url;
    return this.checkLogin(url, route);
  }
  checkLogin(url: string = '/', route: ActivatedRouteSnapshot): boolean {
    const currentUser = this.authService.userSubject.getValue();

    if (this._CookieService.check('Token')) {
      this.authService.redirectUrl = url;

      if (
        route.data.roles &&
        route.data.roles.indexOf(currentUser.role) === -1
      ) {
        // role not authorized so redirect to home page
        this.router.navigate(['/']);
        return false;
      }

      // authorized so return true
      return true;
    }

    // Navigate to the login page with extras
    this.router.navigate(['/doctor-login']);
    return false;
  }
}
