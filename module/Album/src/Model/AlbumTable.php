<?php
namespace Album\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Class AlbumTable
 * @package Album\Model
 */
class AlbumTable
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * AlbumTable constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAlbum(int $id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    /**
     * @param Album $album
     */
    public function saveAlbum(Album $album)
    {
        $data = [
            'artist' => $album->artist,
            'title'  => $album->title,
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getAlbum($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    /**
     * @param $id
     */
    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}