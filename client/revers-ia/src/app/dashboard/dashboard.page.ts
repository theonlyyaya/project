import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: 'dashboard.page.html',
  styleUrls: ['dashboard.page.scss']
})

export class DashboardPage {

  constructor(private router: Router) {}

  goToOfflinePage() {
    this.router.navigate(['/offline']); 
  }

  GoToChoosePlayerDisc() {
    this.router.navigate(['/choose-disc']);
  }

  goToChooseAIDifficultyVSAIFirst() {
    this.router.navigate(['/choose-ai-difficulty-vs-ai-first']); 
  }

  goToHowToPlay() {
    this.router.navigate(['/how-to-play']); 
  }

    openProfile() {
    this.router.navigate(['/profile']); 
  }

}
