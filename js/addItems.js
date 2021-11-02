{
    const $array = <?php echo json_encode($scenarios); ?>;
    const $scenario = [];
    const $datalist = document.querySelector(`.scenario_datalist`);
    const $item = "Hergé";
    
    $array.forEach($item => {
        $scenario.push($item.value);
    });
    
    // $datalist.innerHTML = `<option value="${$item}">`;
    
    
    console.log($array);
}