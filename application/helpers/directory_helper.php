<?php

class ServiceDirectory {
    public function __construct($user) {
        $this->user = $user;
        $this->base_dir = "./" . $user->username;
        error_log($this->base_dir);
        $this->image_dir = $this->base_dir . "/images";
    }

    // Builds all the direcotries for the uyser.
    public function build_all() {
        $this->make_dir();
        $this->make_img_dir();
    }

    // Makes the direcotry for the given user.
    public function make_dir() {
        if(! file_exists($this->base_dir))
            mkdir( $this->base_dir);
    }

    public function make_img_dir() {
        if(! file_exists($this->image_dir))
            mkdir( $this->image_dir );
    }

    // Creates an image from base64encoded string, and
    // returns its path.
    public function create_image($image_name, $image_string) {
        /// Init the image path.
        $image_path = $this->image_dir . "/" . $image_name;

        // Create the file before writing to it.
        $file_handle = fopen($image_path, "wb");
        fclose($file_handle);

        // Decode the image to binary data.
        $image = $this->get_decoded_image($image_string);
        file_put_contents($image_path, $image);

        // Return the created images path.
        return $image_path;
    }

    // Decodes a base64 encoded string and returns binary data.
    private function get_decoded_image($image_string) {
        $image_string = str_replace('data:image/png;base64,', '', $image_string);
        $image_string = str_replace(' ', '+', $image_string);
        return base64_decode($image_string);
    }

    // Gets the encoded image from an image path.
    public function get_encoded_image($image_path) {
        $data = file_get_contents($image_path);

        return base64_encode($data);
    }



}
