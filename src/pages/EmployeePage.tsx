import { Employees } from '@app/components/apps/employees/Employees';
import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { useTranslation } from 'react-i18next';

const EmployeePage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.users')}</PageTitle>
      <Employees />
    </>
  );
};

export default EmployeePage;
