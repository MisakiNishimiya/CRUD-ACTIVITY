<?php
class Sabio {
    private $filename = "data.csv";

    // Constructor to ensure the file exists
    public function __construct() {
        if (!file_exists($this->filename)) {
            // If file doesn't exist, create it with header
            $file = fopen($this->filename, 'w');
            fclose($file);
        }
    }

    // Create - Add a new record to the file
    public function create($data) {
        $file = fopen($this->filename, 'a');
        fputcsv($file, [$data]); // Write data as a new row
        fclose($file);
        echo "Data added successfully: $data\n";
    }

    // Read - Get all records from the file
    public function read() {
        $file = fopen($this->filename, 'r');
        $data = [];
        while (($line = fgetcsv($file)) !== FALSE) {
            $data[] = $line[0]; // Assuming single-column data
        }
        fclose($file);
        return $data;
    }

    // Update - Update a specific record at a given index
    public function update($index, $newData) {
        $data = $this->read();
        if (isset($data[$index])) {
            $data[$index] = $newData;
            // Rewrite the file with updated data
            $file = fopen($this->filename, 'w');
            foreach ($data as $item) {
                fputcsv($file, [$item]);
            }
            fclose($file);
            echo "Data updated successfully.\n";
        } else {
            echo "Invalid index.\n";
        }
    }

    // Delete - Remove a record from the file by index
    public function delete($index) {
        $data = $this->read();
        if (isset($data[$index])) {
            unset($data[$index]);
            // Rewrite the file with remaining data
            $file = fopen($this->filename, 'w');
            foreach ($data as $item) {
                fputcsv($file, [$item]);
            }
            fclose($file);
            echo "Data deleted successfully.\n";
        } else {
            echo "Invalid index.\n";
        }
    }
}

// Create a new instance of the Sabio class
$sabio = new Sabio();

// Sample CRUD operations

// Create
$sabio->create("New Data 1");
$sabio->create("New Data 2");

// Read (Display all data)
echo "Data in file:\n";
$data = $sabio->read();
foreach ($data as $index => $item) {
    echo "$index: $item\n";
}

// Update (Update record at index 0)
$sabio->update(0, "Updated Data 1");

// Read after update
echo "\nData after update:\n";
$data = $sabio->read();
foreach ($data as $index => $item) {
    echo "$index: $item\n";
}

// Delete (Delete record at index 1)
$sabio->delete(1);

// Read after delete
echo "\nData after delete:\n";
$data = $sabio->read();
foreach ($data as $index => $item) {
    echo "$index: $item\n";
}
?>
