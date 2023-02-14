import { Users } from '@app/components/apps/system/users/Users';
import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { useTranslation } from 'react-i18next';

const UsersPage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.users')}</PageTitle>
      <Users />
    </>
  );
};

export default UsersPage;
