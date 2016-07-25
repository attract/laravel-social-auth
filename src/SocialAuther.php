<?php
/**
 * SocialAuther (http://socialauther.stanislasgroup.com/)
 *
 * @author: Stanislav Protasevich
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace AttractGroup\SocialAuther;

use AttractGroup\SocialAuther\Adapter\AdapterInterface;
use Illuminate\Support\Facades\Config;

class SocialAuther
{
    /**
     * Adapter manager
     *
     * @var AdapterInterface
     */

    protected  $adapter = null;

    protected  $urls = null;

    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($adapters, $redirect_uri)
    {
        $urls = '';
        $config = Config::get('social-auther::config.providers');
        foreach($adapters as $row) {
            $config[$row]['redirect_uri'] = $redirect_uri . '?adapter=' . $row;
            $class = 'AttractGroup\SocialAuther\Adapter\\' . ucfirst($row);
            $this->adapter_instance[$row] = new $class($config[$row]);
            $urls[$row] = $this->adapter_instance[$row]->getAuthUrl();
        }

        if (isset($_GET['adapter'])) {
            $name = $_GET['adapter'];
            $this->adapter = $this->adapter_instance[$name];
        }

        $this->urls = $urls;
    }

    /**
     * Call method authenticate() of adater class
     *
     * @return bool
     */
    public function authenticate()
    {
        return $this->adapter != null ? $this->adapter->authenticate() :false;
    }


    /**
     * Return urls auth
     *
     * @return null|string
     */
    public function getAuthUrls()
    {
        return $this->urls;
    }


    /**
     * Call method of this class or methods of adapter class
     *
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if (method_exists($this, $method)) {
            return $this->$method($params);
        }

        if (method_exists($this->adapter, $method)) {
            return $this->adapter->$method();
        }
    }
}