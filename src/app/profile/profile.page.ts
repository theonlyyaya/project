import { Component } from '@angular/core';
import { Camera, CameraOptions } from '@ionic-native/camera/ngx'; // Import Camera module for taking pictures
import { Router } from '@angular/router';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage {
  userImage: string = 'assets/default-profile-image.jpg'; // Default profile image path
  userName: string = '';
  userEmail: string = '';

  constructor(private camera: Camera, private router: Router) {}

  changeProfileImage() {
    // Implement logic to open camera or photo gallery to change profile image
    // Example using Camera plugin (Make sure to install and configure Camera plugin)
    const options: CameraOptions = {
      quality: 100,
      destinationType: this.camera.DestinationType.FILE_URI,
      encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE
    };

    this.camera.getPicture(options).then((imageData: any) => {
      // imageData is either a base64 encoded string or a file URI
      // If it's a file URI, you may want to update the view by setting userImage to the new image path
      this.userImage = (<any>window).Ionic.WebView.convertFileSrc(imageData); // Convert file URI to a format that can be displayed in img tag
    }, (err: any) => {
      console.log('Error taking picture:', err);
    });
  }

  saveProfile() {
    // Implement logic to save user profile details
    console.log('Name:', this.userName);
    console.log('Email:', this.userEmail);
    // Add more logic to save other user details if needed
  }

  logout() {
    // Implement logic to logout the user
    // For example, navigate to the login page
    this.router.navigate(['/login']);
  }
}
