WITH CTE AS(
   SELECT *,
       RN = ROW_NUMBER()OVER(PARTITION BY ReportId ORDER BY ReportId)
   FROM EASOL.ReportAccess
)
DELETE FROM CTE WHERE RN > 1;

CREATE UNIQUE INDEX IX_ReportAccess ON EASOL.ReportAccess (ReportId,RoleTypeId); 

DELETE EASOL.ReportAccess FROM EASOL.ReportAccess
	LEFT JOIN EASOL.Report ON Report.ReportId = ReportAccess.ReportId
	WHERE Report.ReportId IS NULL;


ALTER TABLE [EASOL].ReportAccess
   ADD CONSTRAINT FK_ReportAccess_ReportId
   FOREIGN KEY (ReportId)
   REFERENCES [EASOL].[Report](ReportId) ON UPDATE CASCADE ON DELETE CASCADE;

DELETE EASOL.ReportAccess FROM EASOL.ReportAccess
	LEFT JOIN EASOL.RoleType ON RoleType.RoleTypeId = ReportAccess.RoleTypeId
	WHERE RoleType.RoleTypeId IS NULL;

ALTER TABLE [EASOL].ReportAccess
   ADD CONSTRAINT FK_ReportAccess_RoleTypeId
   FOREIGN KEY (RoleTypeId)
   REFERENCES [EASOL].[RoleType](RoleTypeId) ON UPDATE CASCADE ON DELETE CASCADE;