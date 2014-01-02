

        <div class="span-18 last prepend-top">
	        <table style="border:2px solid #E5ECF9;">
        <tbody>
        <tr>
            <th>Date/Time</th>
            <th>IP Address</th>
            <th>Country</th>
            <th>Region</th>
            <th>City</th>
            <th>Zip Code</th>
            <th>Lon.</th>
            <th>Lat.</th>
        </tr>
        <?php
			$doc = new DOMDocument();
			$doc->load(BASE_URL."logs/iplog.xml");
			
			$ips = $doc->getElementsByTagName( "ips" );
			foreach( $ips as $ip )
			{
				echo "<tr>";
				$dates = $ip->getElementsByTagName( "date" );
				$date = $dates->item(0)->nodeValue;
				$times = $ip->getElementsByTagName( "time" );
				$time = $times->item(0)->nodeValue;
				echo "<td>$date<br>$time</td>";
				$ipAddresses = $ip->getElementsByTagName( "ipAddress" );
				$ipAddress = $ipAddresses->item(0)->nodeValue;
				echo "<td>$ipAddress</td>";
				$countryNames = $ip->getElementsByTagName( "countryName" );
				$countryName = $countryNames->item(0)->nodeValue;
				echo "<td>$countryName</td>";
				$regionNames = $ip->getElementsByTagName( "regionName" );
				$regionName = $regionNames->item(0)->nodeValue;
				echo "<td>$regionName</td>";
				$cityNames = $ip->getElementsByTagName( "cityName" );
				$cityName = $cityNames->item(0)->nodeValue;
				echo "<td>$cityName</td>";
				$zipCodes = $ip->getElementsByTagName( "zipCode" );
				$zipCode = $zipCodes->item(0)->nodeValue;
				echo "<td>$zipCode</td>";
				$longitudes = $ip->getElementsByTagName( "longitude" );
				$longitude = $longitudes->item(0)->nodeValue;
				echo "<td>$longitude</td>";
				$latitudes = $ip->getElementsByTagName( "latitude" );
				$latitude = $latitudes->item(0)->nodeValue;
				echo "<td>$latitude</td>";
			}
		?>
    </tbody>
    </table>
    	</div>

    
