import { PlusOutlined } from '@ant-design/icons';
import { Button } from '@app/components/common/buttons/Button/Button';
import { UsersTable } from '@app/components/tables/Users/UsersTable';
import { useTranslation } from 'react-i18next';
import * as S from './Users.styles';

export const Users: React.FC = () => {
  const { t } = useTranslation();
  return (
    <S.MainWrapper>
      <S.Card
        id={'branches-table'}
        title={t('tables.title', { name: 'Users' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type={'ghost'}
              icon={<PlusOutlined />}
              onClick={() => console.log("CLICK")}
            >
              {t('actions.new', { name: 'Users' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <UsersTable />
      </S.Card>
    </S.MainWrapper>
  )
}