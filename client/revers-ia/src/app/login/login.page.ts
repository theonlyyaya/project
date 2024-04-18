import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage {
  email: string = '';
  password: string = '';

  constructor(private router: Router, private http: HttpClient) {}

  login() {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json'
    });
    this.http.post<string>('http://localhost/reversia_db/login.php', { email: this.email, password: this.password }, { headers, responseType: 'text' as 'json' })
      .subscribe(response => {
        if (response.trim() === 'Login successful') {
          this.router.navigate(['/dashboard']);
        } else {
          console.error('Login error:', response);
        }
      });
  }

  navigateToSignup() {
    this.router.navigate(['/signup']);
  }
}
