<?php

namespace Gallery\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class GalleryService
{

    /**
     * Query builder.
     *
     * @var QueryBuilder
     */
    private $qb;

    /**
     * Init service.
     *
     * @param Connection $connection Database connection.
     */
    public function __construct(Connection $connection)
    {
        $this->qb = $connection->createQueryBuilder();
    }

    /**
     * Get all images.
     *
     * @return array
     */
    public function getImages()
    {
        $query = $this->qb
          ->select('id', 'name', 'type_id', 'created', 'updated')
          ->from('image');

        return $query->execute();
    }

    /**
     * Get image.
     *
     * @param int $id ID of image.
     *
     * @return array
     */
    public function getImage($id)
    {
        $query = $this->qb
          ->select('name', 'type_id')
          ->from('image')
          ->where('id=?')
          ->setParameter(0, $id);

        return $query->execute()->fetch();
    }

    /**
     * Created new image from submited form data.
     *
     * @param array $data Array of submited form data.
     *
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    public function createImage($data)
    {
        $query = $this->qb
          ->insert()
          ->insert('image')
          ->setValue('name', '?')
          ->setValue('type_id', '?')
          ->setValue('created', '?')
          ->setValue('updated', '?')
          ->setParameter(0, $data['name'])
          ->setParameter(1, $data['type_id'])
          ->setParameter(2, time())
          ->setParameter(3, time());

        return $query->execute();
    }

    public function editImage($id, $data)
    {
        $query = $this->qb
            ->update('image')
            ->set('name', '?')
            ->set('type_id', '?')
            ->set('updated', '?')
            ->where('id= ?')
            ->setParameter(0, $data['name'])
            ->setParameter(1, $data['type_id'])
            ->setParameter(2, time())
            ->setParameter(3, $id);

        return $query->execute();
    }

    public function deleteImage($id)
    {
        $query = $this->qb
            ->delete('image')
            ->where('id= ?')
            ->setParameter(0, $id);

        return $query->execute();
    }
}
