<?php

namespace App\Modules\Models;

use PDO;
use DateTime;
use PDOException;
use PDOStatement;
use App\Modules\App;
use Doctrine\Inflector\InflectorFactory;
use Exception;

abstract class BaseModel
{
    protected $inflector;

    abstract protected function getAttributes(): array;

    /**
     * Ottiene il nome della tabella corrispondente alla classe.
     *
     * @return string
     */
    protected static function getTableName(): string
    {
        $className = substr(strrchr(static::class, "\\"), 1);
        $inflector = InflectorFactory::create()->build();
        $pluralClassName = $inflector->pluralize($className);

        return strtolower($pluralClassName);
    }

    /**
     * Esegue una query sul database utilizzando PDO.
     *
     * @param string $query
     * @param array|null $params
     * @return bool
     */
    protected static function executeQuery($query, $params = []): bool
    {
        try {
            $statement = App::$app->database->pdo->prepare($query);
            $statement->execute($params);

            return true;
        } catch (PDOException $e) {
            error_log("Errore nell'esecuzione della query: " . $e->getMessage());

            return false;
        }
    }

    /**
     * Esegue una query SQL di selezione e restituisce i risultati.
     *
     * @param string $query
     * @param array|null $params
     * @return array
     */
    public static function select($query, $params = []): array|static
    {
        try {
            $pdo = App::$app->database->pdo;
            $statement = $pdo->prepare($query);
            $statement->execute($params);

            $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);

            $data = [];

            foreach ($queryResult as $record) {
                $instance = new static();

                foreach ($record as $key => $value) {
                    if ($key === 'updated_at' || $key === 'created_at') {
                        $instance->$key = new DateTime($value);
                    } else {
                        $instance->$key = $value;
                    }
                }

                $data[] = $instance;
            }

            if (count($data) === 1) {
                return $data[0];
            }

            return $data;
        } catch (PDOException $e) {
            error_log("Errore nell'ottenimento dei dati: " . $e->getMessage());

            return [];
        }
    }

    /**
     * Salva un nuovo record nel database.
     *
     * @param array $params
     * @return bool
     */
    public static function insert(array $params): bool
    {
        $tableName = static::getTableName();

        $attributes = array_keys($params);
        $placeholders = implode(', ', array_map(fn ($column) => ":$column", $attributes));

        $query = "INSERT INTO $tableName (" . implode(', ', $attributes) . ") VALUES ($placeholders)";

        return self::executeQuery($query, $params);
    }

    /**
     * Aggiorna il record nel database con i nuovi valori forniti.
     *
     * @param array $params
     * @return bool
     */
    public function update(array $params)
    {
        $tableName = static::getTableName();

        $attributes = array_keys($params);
        $placeholders = implode(', ', array_map(fn ($column) => "$column = :$column", $attributes));
        $params['id'] = $this->id;

        $query = "UPDATE $tableName SET $placeholders WHERE id = :id";

        foreach ($params as $key => $value) {
            if ($value instanceof DateTime) {
                $params[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        try{
            self::executeQuery($query, $params);
        }
        catch(Exception $e){
            error_log($e);
            return false;
        }

        foreach ($params as $key => $value) {
             $this->$key = $value;
        }

        return true;
    }

    /**
     * Cancella il record dal database.
     *
     * @return bool
     */
    public function destroy(): bool
    {
        $tableName = static::getTableName();

        $query = "DELETE FROM $tableName WHERE id = :id";

        return self::executeQuery($query, ['id' => $this->id]);
    }
}
