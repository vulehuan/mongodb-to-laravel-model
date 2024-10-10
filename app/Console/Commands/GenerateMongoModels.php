<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use MongoDB\Client;

class GenerateMongoModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-mongo-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate mongodb models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mongoClient = new Client("mongodb://" . env('DB_HOST') . ":" . env('DB_PORT'));
        $db = $mongoClient->{env('DB_DATABASE')};

        // Fetch all collections in the database
        $collections = $db->listCollections();

        // Directory where models will be generated
        $modelDirectory = app_path('Models');

        // Make sure the directory exists
        if (!File::exists($modelDirectory)) {
            File::makeDirectory($modelDirectory);
        }

        foreach ($collections as $collection) {
            $collectionName = $collection->getName();
            $modelName = ucfirst(Str::camel(Str::singular($collectionName))); // Convert collection name to a model name

            $modelFilePath = "$modelDirectory/$modelName.php";

            // Create the model file only if it doesn't exist
            if (!File::exists($modelFilePath)) {
                $modelTemplate = <<<EOT
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class $modelName extends Model
{
    use HasFactory;
    protected \$connection = 'mongodb';
    protected \$collection = '$collectionName';
}
EOT;

                // Save the model file
                File::put($modelFilePath, $modelTemplate);

                echo "Model for collection '$collectionName' created: $modelName.php\n";
            } else {
                echo "Model for collection '$collectionName' already exists: $modelName.php\n";
            }
        }
    }
}
