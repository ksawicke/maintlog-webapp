<h3>Komatsu Maintenance Log</h3>

<p>Current application version <?php echo APPLICATION_VERSION; ?></p>

<br />

<ul><strong>Application updates</strong>
	<li>3.0.7
		<ul>
			<li>Adjust Log Entry detail to remove troubleshooting data at bottom</li>
		</ul>
	</li>
	<li>3.0.6
		<ul>
			<li>Adjust Excel report for Inspection Entries to show note of bad items</li>
		</ul>
	</li>
	<li>3.0.5
		<ul>
			<li>Adjusted check of images - remove HTTPS</li>
		</ul>
	</li>
	<li>3.0.4
		<ul>
			<li>Adjusted inspection image orientation on Inspection Entry Detail page</li>
		</ul>
	</li>
	<li>3.0.3
		<ul>
			<li>Changed the color of pagination links to match theme</li>
			<li>Log Entry Report - changed the sort to reverse order on Log Entry ID instead of Date; This ensures you see most recent Log Entry at top of report</li>
		</ul>
	</li>
	<li>3.0.2
		<ul>
			<li>Updated the Inspection Entry screen view as well as detail view to match data represented in the updated Excel spreadsheet (v 3.0.1)</li>
		</ul>
	</li>
	<li>3.0.1
		<ul>
			<li>Adjusted the Inspection Entry Excel download report to add additional columns</li>
			<li>Adjusted the Inspection Entry Excel download report to show all checklist items then mark appropriate GOOD/BAD entries that were checked off during inspection</li>
		</ul>
	</li>
	<li>3.0.0
		<ul>
			<li>Update API to handle SMR updates as related to inspections</li>
			<li>Add new reporting for Inspection Entry</li>
			<li>Add new view to see a single Inspection Entry</li>
		</ul>
	<li>2.8.4
		<ul>
			<li>Update API endpoint for Inspection Ratings to check if Inspection ID does not exist before uploading.</li>
		</ul>
	</li>
	<li>2.8.3
		<ul>
			<li>Update Checklist save</li>
		</ul>
	</li>
	<li>2.8.2
		<ul>
			<li>Update Checklist query</li>
		</ul>
	</li>
	<li>2.8.1
		<ul>
			<li>Correct bug in Fuel Used Report</li>
		</ul>
	</li>
	<li>2.8
		<ul>
			<li>Updates to API to work with iOS application</li>
		</ul>
	</li>
	<li>2.7.2
		<ul>
			<li>Correct bug in Log Entry Report</li>
		</ul>
	</li>
	<li>2.7.1
		<ul>
			<li>Remove "Reporting" link on main screen</li>
			<li>All reports with date column first, order by date descending order, allow sort</li>
			<li>Log Entry Report - fix why date is not always showing in descending order
			</li>
			<li>Change "Reporting/Fuel Used" to "Fluids Used" and "Fluids Used Report"</li>
			<li>Log Entry - Fuel: add note at end</li>
		</ul>
	</li>
	<li>2.7
		<ul>
			<li>API set up to allow Inspections to be submitted from iOS app coming soon</li>
			<li>Changed "Serviced By" to default to logged in user on new Log Entry</li>
			<li>Added field "Group" when entering a new User</li>
		</ul>
	</li>

	<li>2.6
		<ul>
			<li>"Service Logs Report" -> rename to "Log Entry Report"</li>
			<li>"SMR / Miles / Time Used Report" -> rename to "Mileage Used Report"; also last 3 cols change to "SMR/Miles"</li>
			<li>Enable Milage Used Report</li>
			<li>Log Entry Detail - added SMR for Fluid Entry update</li>
		</ul>
	</li>

	<li>2.5.3
		<ul>
			<li>Service Report dump to Excel - corrected which cell the SMR value appears</li>
		</ul>
	</li>

	<li>2.5.1
		<ul>
			<li>Added the about section</li>
		</ul>
	</li>

	<li>2.5.0
		<ul>
			<li>Added new report (Reporting menu -> Fuel Used); can be used to see fuel used during a date range</li>
			<li>Added link to future report (Reporting menu -> SMR/Miles/Units Used)</li>
			<li>Service Logs Report - Added new filtering by date range</li>
			<li>Service Logs Report - Updated the Download to Excel to add fuel used</li>
			<li>Refining the Inspection Log entry feature (coming soon)</li>
			<li>Fluid Entry - allow entering notes after SMR/Miles/Time value</li>
			<li>When downloading to Excel the Service Logs Report, put the amount of fluids (4.5 gal 10 W 40) not just type</li>
			<li>On the Service Logs Report, show the amount of fluids even if not filtered on Fluid Entry</li>
			<li>Check dynamic labelling feature…not everything should be labeled as SMR ... some Miles ... some Time</li>
			<li>Equipment List Report -- add new 1st column "Equipment Type"</li>
		</ul>
	</li>


