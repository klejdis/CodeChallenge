<?php
/**
 * Class Dijkstra
 * This class is a wrapper for Dijkstra Algorithm
 *
 * @author Klejdis Jorgji
 */
class Dijkstra
{
    /**
     * The graph array which hold nodes with their weights
     *
     * @var array
     */
    protected $graph;

    /**
     * First node
     *
     * @var string
     */
    protected $firstVertex;

    /**
     * Last node
     *
     * @var string
     */
    protected $lastVertex;

    /**
     * Create a new Djikstra
     *
     * @param array $graph
     * @return void
     */
    public function __construct($graph) {
        $this->graph = $this->formatInput($graph);
    }

    /**
     * This calculated the shortest path between 2 nodes
     *
     * @param  string  $source
     * @param  string  $target
     * @return string
     */
    public function shortestPath($source, $target) {
       $dijktra =  new \Fisharebest\Algorithm\Dijkstra($this->graph);
       $result  =  $dijktra->shortestPaths($source,$target);

       //if no route between points return -1
       if (count($result) == 0){
           return -1;
       }

       return implode('-', $result[0]);
    }

    /**
     * Finds the shortest path between first node and the last
     *
     * @return string
     */
    public function shortestPathFirstNodeToLast(){
       return $this->shortestPath($this->firstVertex, $this->lastVertex);
    }

    /**
     * Formats the array in easier format to insert in the SplPriorityQueue
     *
     * @param  array $graph
     * @return array|null
     */
    private function formatInput($graph){
        $formatedGraph = [];

        //validate the input
        if (count($graph) == 0){
            return null;
        }

        //first element of array is the size of nodes
        $nodesLength = $graph[0];

        $this->firstVertex = $graph[1];
        $this->lastVertex  = $graph[$nodesLength];

        //loop through the nodes
        for($i = 1;$i <= $nodesLength; $i++ ){
            $formatedGraph[$graph[$i]] = [];
        }

        //loop through the nodes connections
        for($i = $nodesLength+1;$i <= count($graph)-1; $i++ ){

            //explode the string  for eg: A|B|1 where A goes to B with weight 1
            $exploded = explode('|', $graph[$i]);

            $from = $exploded[0];
            $to = $exploded[1];
            $weight = $exploded[2];

            $formatedGraph[$from][$to] = $weight;
        }

        return $formatedGraph;
    }

}