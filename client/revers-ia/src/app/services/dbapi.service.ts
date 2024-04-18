import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DbapiService {
  private apiLogin = 'http://localhost/reversia_db/login.php';
  private apiSignup = 'http://localhost/reversia_db/signup.php';

  constructor(private http: HttpClient) { }

  login(email: string, password: string): Observable<string> {
    return this.http.post(this.apiLogin, { email, password }, { responseType: 'text' });
  }

  signUp(username: string, email: string, password: string, country: string): Observable<string> {
    return this.http.post(this.apiSignup, { username, email, password, country }, { responseType: 'text' });
  }
}
