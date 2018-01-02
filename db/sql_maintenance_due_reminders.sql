SELECT
		    s.date_entered, pm.current_smr, man.manufacturer_name, em.model_number, eu.unit_number, pm.pm_type,  pm.due_units, pm.notes,
		    CASE pm.pm_type
			   WHEN 'smr_based' THEN smr.smr_choice
			   WHEN 'mileage_based' THEN mileage.mileage_choice
			   WHEN 'time_based' THEN time.time_choice
			   ELSE -1
			END AS pm_level
		FROM pmservice pm
		LEFT JOIN servicelog s on s.id = pm.servicelog_id
		LEFT JOIN equipmentunit eu ON eu.id = s.unit_number
		LEFT JOIN equipmentmodel em on em.id = eu.equipmentmodel_id
		LEFT JOIN manufacturer man on man.id = em.manufacturer_id
		LEFT OUTER JOIN smrchoice smr ON (smr.id = pm.pm_level AND pm.pm_type = 'smr_based')
		LEFT OUTER JOIN mileagechoice mileage ON (mileage.id = pm.pm_level AND pm.pm_type = 'mileage_based')
LEFT OUTER JOIN timechoice time ON (time.id = pm.pm_level AND pm.pm_type = 'time_based')