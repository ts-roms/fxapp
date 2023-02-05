import { Branches } from '@app/components/apps/system/branches/Branches';
import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { useTranslation } from 'react-i18next';

const BranchesPage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.branches')}</PageTitle>
      <Branches />
    </>
  );
};

export default BranchesPage;
