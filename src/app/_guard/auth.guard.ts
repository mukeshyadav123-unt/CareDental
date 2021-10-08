import { Injectable } from '@angular/core';
import {
  CanActivate,
  ActivatedRouteSnapshot,
  RouterStateSnapshot,
  Router,
} from '@angular/router';
import { Observable } from 'rxjs';
import { UserService } from '../services/user.service';
import { CookieService } from 'ngx-cookie-service';

@Injectable()
export class AuthGuard implements CanActivate {
  constructor(
    protected router: Router,
    protected _UserService: UserService,
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
    if (this._CookieService.check('Token')) {
      // // Store the attempted URL for redirecting
      // this._UserService.redirectUrl = url;

      // authorised so return true
      return true;
    }

    // Navigate to the login page with extras
    this.router.navigate(['/doctor-login']);
    return false;
  }
}
